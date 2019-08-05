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
    handleSend(){

        const user = JSON.parse(this.props.user);

        const inputElement = document.getElementById('messageText');

        let messageList = this.state.messages;

        messageList.push({
            senderName: user.name,
            messageText: inputElement.value,
            messageSentDate: new Date().toLocaleTimeString()
        });

        this.setState({
            messages : messageList
        });

        inputElement.value = "";
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
                <MessagesArea messageList={messageList} />
                <div className='card-footer'>
                    <InputArea onClick={this.handleSend} ></InputArea>
                </div>
            </div>
        );
    }
}


class MessagesArea extends React.Component{
    render(){
        return(
            <div className='card-body message-output'>
                {this.props.messageList}
            </div>
        );
    }
}

class InputArea extends React.Component{
    render() {
        return (
            <form className='form'>
                <div className='row'>
                    <textarea className='message-input col-md-8' id='messageText' type='text' placeholder='Message...' ></textarea>
                    <button type='button' className='btn btn-dark btn-block col-md-2' onClick={this.props.onClick}> <i className='fa fa-send'></i> </button>
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
