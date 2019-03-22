import React from "react";
import ChildrenList from "./childrenList";

export default class ChildrenListSearchBar extends React.Component {
    constructor(props, context) {
        super(props, context);
        this.state = {
            filterText: ""
        };
    }

    onChangeSearch(evt) {
        this.setState({ filterText: evt.target.value });
    }

    filterChildren() {
        return this.props.children.filter(child => {
            if (this.state.filterText !== "" && child.firstname.toLowerCase().indexOf(this.state.filterText) === -1) {
                return false;
            }
            return true;
        });
    }

    render() {
        return (
            <div className="container">
                <div id="search-box" className="pull-right">
                    <div className="input-group">
                        <input
                            type="text"
                            className="form-control"
                            value={this.state.filterText}
                            placeholder="Search for..."
                            onChange={this.onChangeSearch.bind(this)}
                        />
                    </div>
                </div>
                <h2>List of children</h2>
                <ChildrenList
                    children={this.filterChildren()}
                    routePrefix={this.props.routePrefix}
                />
            </div>
        );
    }
}
