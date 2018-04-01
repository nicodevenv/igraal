import React, { Component } from 'react';

export default class UserData extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: this.props.idUser,
            name: '',
            email: '',
            profileUrl: '',
            isLoading: true,
        };

        this.loadUser();
    }

    loadUser() {
        fetch(this.props.apiBaseUrl + '/user/' + this.props.idUser)
            .then((response) => response.json())
            .then((result) => {
                this.setState({
                    name: result.name,
                    email: result.email,
                    profileUrl: result.profileUrl,
                    isLoading: false,
                });
            })
            .catch((error) => {
                console.error(error);
            });
    }

    render() {
        return (
            <div>
                {this.state.isLoading ? <span>Loading user data, please wait...</span> : null}
                {
                    !this.state.isLoading ?
                    <div className="user-data">
                        <div className="user-id">ID : {this.state.id}</div>
                        <div className="user-name">Name : {this.state.name}</div>
                        <div className="user-email">Email : {this.state.email}</div>
                        <div className="user-profile-url">Profile url : {this.state.profileUrl}</div>
                    </div>
                    : null
                }

            </div>
        )
    }
}
