import React, { Component } from 'react';
import UserData from './UserData';
import $ from 'jquery';

export default class Register extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            name: '',
            profileUrl: '',
            registerResponse: '',
            registerComplete: false,
            isRegistering: false,
        };
        this.handleRegisterEmail = this.handleRegisterEmail.bind(this);
        this.handleRegisterPassword = this.handleRegisterPassword.bind(this);
        this.handleRegisterName = this.handleRegisterName.bind(this);
        this.handleRegisterProfileUrl = this.handleRegisterProfileUrl.bind(this);
    }

    handleRegisterEmail(event) {
        this.setState({email: event.target.value});
    }

    handleRegisterPassword(event) {
        this.setState({password: event.target.value});
    }

    handleRegisterName(event) {
        this.setState({name: event.target.value});
    }

    handleRegisterProfileUrl(event) {
        this.setState({profileUrl: event.target.value});
    }

    register() {
        this.setState({isRegistering: true});
        const currentModule = this;
        $.ajax({
            method: "POST",
            dataType:"json",
            url: this.props.apiBaseUrl + "/user/register",
            data: JSON.stringify({
                name: currentModule.state.name,
                email: currentModule.state.email,
                password: currentModule.state.password,
                profileUrl: currentModule.state.profileUrl,
            })
        })
        .done(function( result ) {
            currentModule.setState({
                registerResponse: result,
                registerComplete: true,
                isRegistering:false,
            });
        });
    }

    render() {
        return (
            <div className="register-block">
                <input type="text" placeholder="email" value={this.state.email} onChange={this.handleRegisterEmail} />
                <input type="password" placeholder="password" value={this.state.password} onChange={this.handleRegisterPassword} />
                <input type="text" placeholder="name" value={this.state.name} onChange={this.handleRegisterName} />
                <input type="text" placeholder="profileUrl" value={this.state.profileUrl} onChange={this.handleRegisterProfileUrl} />
                <button onClick={() => this.register()}>Register</button>

                {this.state.isRegistering ? <span>Loading please wait...</span> : null}
                {this.state.registerComplete && !this.state.isRegistering ? <UserData data={this.state.registerResponse}/> : null}
            </div>
        )
    }
}
