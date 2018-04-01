import React, { Component } from 'react';
import $ from 'jquery';

export default class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            isLoggingIn: false,
            loginComplete: false,
            loggedUser: 0,
            loginResponse: null,
        };

        this.handleEmail = this.handleEmail.bind(this);
        this.handlePassword = this.handlePassword.bind(this);
    }

    handleEmail(event) {
        this.setState({email: event.target.value});
    }

    handlePassword(event) {
        this.setState({password: event.target.value});
    }

    login() {
        this.setState({isLoggingIn: true});
        const currentModule = this;
        $.ajax({
            method: "POST",
            dataType:"json",
            url: this.props.apiBaseUrl + "/user/login",
            data: JSON.stringify({
                email: currentModule.state.email,
                password: currentModule.state.password,
            })
        })
            .done(function( result ) {
                currentModule.setState({
                    loginResponse: result,
                    loginComplete: true,
                    isLoggingIn:false,
                });

                if (JSON.stringify(currentModule.state.loginResponse) === '{}') {
                    currentModule.props.handleChangeUser(0);
                } else {
                    currentModule.props.handleChangeUser(currentModule.state.loginResponse.id);
                }
            });
    }

    render() {
        return (
            <div className="login-block">
                <input type="text" placeholder="email" value={this.state.email} onChange={this.handleEmail}/>
                <input type="password" placeholder="password" value={this.state.password} onChange={this.handlePassword}/>
                <button onClick={() => this.login()}>Log in</button>
                {this.state.isLoggingIn ? <span>Logging in please wait...</span> : null}
            </div>
        )
    }
}