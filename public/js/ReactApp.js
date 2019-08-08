'use strict';

class ChatBox extends React.Component{
    constructor(props){
        super(props);

        const data = JSON.parse(this.props.messages);

        const receiverId = JSON.parse(this.props.receiverId);

        this.state = {
            currentMessage: '',
            messages: data,
            currentReceiverId: receiverId
        }

        this.handleSend = this.handleSend.bind(this);
        this.handleTyping = this.handleTyping.bind(this);
        this.handleReceiverChange = this.handleReceiverChange.bind(this);

    }
    componentDidMount() {
        this.timerID = setInterval(
            () => this.tick(),
            2000
        );
    }
    componentWillUnmount() {
        clearInterval(this.timerID);
    }
    tick() {
        this.getMessages(this.state.currentReceiverId);
    }
    handleSend(){

        const user = JSON.parse(this.props.user);

        const receiver_id = this.state.currentReceiverId;

        if (receiver_id==0){
            this.setState({currentMessage:''});
            return;
        }

        const currentMessage = this.state.currentMessage;

        fetch('/messages/'+receiver_id, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.props.csrf,
            },
            body: JSON.stringify({
                sender_id: user.id,
                receiver_id: receiver_id,
                messageText: currentMessage
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

        this.setState({currentMessage:''});
    }
    handleTyping(event){
        this.setState({currentMessage: event.target.value});
    }
    handleReceiverChange(event){
        this.setState({
            currentReceiverId: event.target.id
        });
        this.getMessages(event.target.id);
    }
    getMessages(receiverId){

        const receiver = receiverId;

        fetch('/messages/'+receiverId)
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
    render() {
        const messages = this.state.messages;

        const messageList = messages.map((message)=>
            <p><strong>{message.sender.name ? message.sender.name : 'Unknown User'}</strong>: {message.messageText}</p>
        );

        const userList = JSON.parse(this.props.users);

        return (
            <div className='row'>
                <div className='card col-md-6'>
                    <div className='card-header'>
                        Chat Box
                    </div>
                    <MessagesArea messageList={messageList} ref={(el)=>{this.messagesArea=el;}} />
                    <div className='card-footer'>
                        <InputArea onClick={this.handleSend}
                                   messagesArea={this.messagesArea}
                                   currentMessage={this.state.currentMessage}
                                   handleTyping={this.handleTyping}>
                        </InputArea>
                    </div>
                </div>
                <div className='card col-md-3'>
                    <div className='card-header'>
                        Contact List
                    </div>
                    <div className='card-body'>
                        <Contacts userList={userList}
                                  currentReceiverId={this.state.currentReceiverId}
                                  onReceiverChange={this.handleReceiverChange}/>
                    </div>
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
                              value={this.props.currentMessage}
                              placeholder='Message...'
                              onKeyPress={this.handleEnter}
                              onChange={this.props.handleTyping}
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

class Contacts extends React.Component{
    render() {

        const currentReceiverId = this.props.currentReceiverId;

        const userList = this.props.userList;

        const users = userList.map((user)=>
            <button className={currentReceiverId==user.id ? 'btn btn-dark btn-block' : 'btn btn-info btn-block'}
                    key={user.id}
                    id={user.id}
                    onClick={this.props.onReceiverChange}>
                {user.name}
            </button>
        );
        return (
            <div className='card-body'>
                {users}
            </div>
        );
    }
}