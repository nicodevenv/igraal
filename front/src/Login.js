import React, { Component } from 'react';

export default class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            isLoggingIn: false,
            loginComplete: false,
            loggedUser: 0,
        }
    }

    login() {
        this.props.handleChangeUser(0);
        this.props.handleLoggedInState(true);
    }

    render() {
        return (
            <div className="login-block">
                <button onClick={() => this.login()}></button>
            </div>
        )
    }
}