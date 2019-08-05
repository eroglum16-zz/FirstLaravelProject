'use strict';

class ChatBox extends React.Component{
    constructor(props){
        super(props);

        const data = JSON.parse(this.props.messages);

        this.state = {
            messages: data
        }

        //document.getElementById('temp-message').innerText = this.props.messages;

        this.handleSend = this.handleSend.bind(this);
    }
    componentDidMount() {
        this.timerID = setInterval(
            () => this.tick(),
            3000
        );
    }
    componentWillUnmount() {
        clearInterval(this.timerID);
    }
    tick() {
        fetch('/messages')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({
                    messages: responseJson
                });
            })
            .catch((error) => {
                console.error(error);
            });
    }
    handleSend(){

        const user = JSON.parse(this.props.user);

        const receiver_id = user.id==1 ? 2 : 1 ;

        const inputElement = document.getElementById('messageText');

        fetch('/messages', {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.props.csrf,
            },
            body: JSON.stringify({
                sender_id: user.id,
                receiver_id: receiver_id,
                messageText: inputElement.value
            }),
        }).then((response) => response.json())
            .then((responseJson) => {
                this.setState({
                    messages: responseJson
                });
            })
            .catch((error) => {
                console.error(error);
            });


        inputElement.value = "";
        var element = document.getElementById('scrollingContainer');
        element.scrollTop = element.scrollHeight - element.clientHeight;

    }
    render() {
        const messages = this.state.messages;

        const messageList = messages.map((message)=>
            <p><strong>{message.sender.name ? message.sender.name+':' : ''}</strong> {message.messageText}</p>
        );

        return (
            <div className='card col-md-6'>
                <div className='card-header'>
                    Chat Box
                </div>
                <MessagesArea messageList={messageList} ref={(el)=>{this.messagesArea=el;}} />
                <div className='card-footer'>
                    <InputArea onClick={this.handleSend} messagesArea={this.messagesArea} ></InputArea>
                </div>
            </div>
        );
    }
}


class MessagesArea extends React.Component{
    scrollToBottom = () => {
        this.messagesEnd.scrollIntoView({ behavior: "smooth" });
    }

    componentDidMount() {
        this.scrollToBottom();
    }

    componentDidUpdate() {
        this.scrollToBottom();
    }
    render(){
        return(
            <div className='card-body message-output' >
                {this.props.messageList}
                <div style={{ float:"left", clear: "both" }}
                     ref={(el) => { this.messagesEnd = el; }}>
                </div>
            </div>
        );
    }
}

class InputArea extends React.Component{
    constructor(props) {
        super(props);
        this.handleEnter = this.handleEnter.bind(this);
    }

    handleEnter(target){
        if(target.charCode==13){
            target.preventDefault();
            this.sendButton.click();
        }
        this.props.messagesArea.scrollToBottom;
    }

    render() {
        return (
            <form className='form'>
                <div className='row'>
                    <textarea className='message-input col-md-8'
                              id='messageText'
                              type='text'
                              placeholder='Message...'
                              onKeyPress={this.handleEnter}
                              autoFocus={true}>
                    </textarea>
                    <button className='btn btn-dark btn-block col-md-2'
                            type='button'
                            onClick={this.props.onClick}
                            ref={(el) => { this.sendButton = el; }}>
                        <i className='fa fa-send'></i>
                    </button>
                </div>
            </form>
        );
    }
}


class AlbumInfo extends React.Component{
    constructor(props) {
        super(props);
        this.state = {album: JSON.parse(this.props.album)};
    }
    componentDidMount() {
        this.timerID = setInterval(
            () => this.tick(),
            5000
        );
    }
    componentWillUnmount() {
        clearInterval(this.timerID);
    }
    tick() {

        fetch("serveAlbum/1")
            .then(res => res.json())
            .then(
                (result) => {
                    this.setState({
                        album: result
                    });
                },
            )
    }
    render() {
        return (
            <li>
               <span>{this.state.album.title}</span><i> by </i><strong>{this.state.album.artist}</strong>
            </li>
        );
    }
}
