import React, { Component } from 'react';

export default class Commission extends Component {
    constructor(props) {
        super(props);
        this.state = {
            commissions: [],
            isLoaded:false,
            isLoading: true,
        };

        this.loadCommissions();
    }

    loadCommissions() {
        fetch(this.props.apiBaseUrl + '/commissions/' + this.props.idUser)
            .then((response) => response.json())
            .then((result) => {
                this.setState({
                    commissions: result,
                    isLoaded: true,
                    isLoading: false,
                });
            })
            .catch((error) => {
                console.error(error);
            });
    }

    render() {
        return(
            <div>
                {this.state.isLoading ? <span>Loading commissions please wait...</span> : null}
                {this.state.isLoaded && this.state.commissions.length === 0 ? <span>no commission found</span> : null}
                {
                    this.state.isLoaded && this.state.commissions.length > 0 ?
                    this.state.commissions.map(function(data, index){
                            return <div key={index}>
                                <div>Date: {data.date}</div>
                                <div>Amount: {data.cashback}</div>
                                <div>Merchant: {data.merchant}</div>
                            </div>;
                        })
                    : null}
            </div>
        )
    }
}