import React, { Component } from 'react';
import './App.css';
import Register from './Register';

class App extends Component {
  constructor(props) {
      super(props);
      this.state = {
          apiBaseUrl: 'http://localhost:8000'
      };
  }

  render() {
    return (
      <div className="App">
        <Register apiBaseUrl={this.state.apiBaseUrl}/>
      </div>
    );
  }
}

export default App;
