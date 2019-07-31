'use strict';

class WelcomeMessage extends React.Component{
    render(){
        return(
            <p>Welcome {this.props.name}</p>
        );
    }
}

class MessagesArea extends React.Component{
    render(){
        return(
            <div className='card-body message-output'>

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

class ChatBox extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            messages: []
        }
        this.handleSend = this.handleSend.bind(this);
    }
    handleSend(){
        this.setState({
            messages : {
                senderName: 'Mert',
                message: document.getElementById('messageText').value,
                messageSentDate: new Date().toLocaleTimeString()
            }
        });
        document.getElementById('messageText').value = "";
    }
    render() {
        return (
            <div className='card col-md-6'>
                <div className='card-header'>
                    Chat Box
                </div>
                <div className='card-body message-output'>
                    <p><strong>{this.state.messages.senderName ? this.state.messages.senderName+':' : ''}</strong> {this.state.messages.message}</p>
                </div>
                <div className='card-footer'>
                    <InputArea onClick={this.handleSend} ></InputArea>
                </div>
            </div>
        );
    }
}

class LikeButton extends React.Component {
    constructor(props) {
        super(props);
        this.state = { liked: false };
    }

    render() {
        if (this.state.liked) {
            return (
                <div>

                    <i className='fa fa-heart likeHeart' onClick={() => this.setState({ liked: false }) } ></i>
                </div>
            );
        }

        let data = JSON.parse(this.props.data);

        return (

            <div>
                <i className='fa fa-heart-o likeHeart' onClick={() => this.setState({ liked: true }) } ></i>



                <WelcomeMessage name={data.name} />

                <p><strong>Age: </strong>{data.age}</p>
                <p><strong>City: </strong>{data.city}</p>


            </div>
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
