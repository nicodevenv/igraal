import React, { Component } from 'react';
import './App.css';
import Register from './Register';
import Login from './Login';

class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            apiBaseUrl: 'http://localhost:8000',
            loggedUser: null,
        };

        this.handleChangeUser = this.handleChangeUser.bind(this);
        this.handleLoggedInState = this.handleLoggedInState.bind(this);
    }

    handleChangeUser(idUser) {
        this.setState({loggedUser: idUser});
    }

    handleLoggedInState(loginState) {
        this.setState({loggedIn: loginState});
    }

    render() {
        return (
            <div className="App">
                <Register apiBaseUrl={this.state.apiBaseUrl}/>
                {this.state.loggedUser > 0 ? <span>loggedIn</span> : null}
                {this.state.loggedUser === 0 ? <span>Authentication data error</span> : null}
                {this.state.loggedUser === null || this.state.loggedUser === 0 ?
                    <Login apiBaseUrl={this.state.apiBaseUrl} handleChangeUser={this.handleChangeUser} handleLoggedInState={this.handleLoggedInState}/>
                    : null
                }
            </div>
        );
    }
}

export default App;
