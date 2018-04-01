import React, { Component } from 'react';
import './App.css';
import Register from './Register';
import Login from './Login';
import Commission from './Commission';

class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            apiBaseUrl: 'http://localhost:8000',
            loggedUser: null,
        };

        this.handleChangeUser = this.handleChangeUser.bind(this);
    }

    handleChangeUser(idUser) {
        this.setState({loggedUser: idUser});
    }

    render() {
        return (
            <div className="App">
                {
                    this.state.loggedUser === null || this.state.loggedUser === 0 ?
                        <div>
                            <Register apiBaseUrl={this.state.apiBaseUrl}/>
                            <Login apiBaseUrl={this.state.apiBaseUrl} handleChangeUser={this.handleChangeUser}/>
                        </div>
                    : null
                }
                {this.state.loggedUser === 0 ? <span>Authentication data error</span> : null}
                {this.state.loggedUser > 0 ? <Commission apiBaseUrl={this.state.apiBaseUrl} idUser={this.state.loggedUser}/> : null}
            </div>
        );
    }
}

export default App;
