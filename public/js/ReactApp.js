'use strict';

class WelcomeMessage extends React.Component{
    render(){
        return(
            <p>Welcome {this.props.name}</p>
        );
    }
}

class ChatBoxHeader extends React.Component{
    render() {
        return (
            <div className='card-header'>
                Chat Box
            </div>
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
                    <textarea className='message-input col-md-7' type='text' placeholder='Message...' ></textarea>
                    <button type='submit' className='btn btn-dark btn-block col-md-3'>Send</button>
                </div>

            </form>
        );
    }
}

class ChatBox extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            messages : []
        }
    }
    render() {
        return (
            <div className='card col-md-6'>
                <ChatBoxHeader/>
                <MessagesArea/>
                <div className='card-footer'>
                    <InputArea/>
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
