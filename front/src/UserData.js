import React, { Component } from 'react';

export default class UserData extends Component {
    constructor(props) {
        super(props);
        this.state = {
            id: props.data.id,
            name: props.data.name,
            email: props.data.email,
            profileUrl: props.data.profileUrl,
        }
    }

    render() {
        return (
            <div className="user-data">
                <div className="user-id">ID : {this.state.id}</div>
                <div className="user-name">Name : {this.state.name}</div>
                <div className="user-email">Email : {this.state.email}</div>
                <div className="user-profile-url">Profile url : {this.state.profileUrl}</div>
            </div>
        )
    }
}
