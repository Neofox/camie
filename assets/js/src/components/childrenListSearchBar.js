import React from "react";
import ChildrenList from "./childrenList";

export default class ChildrenListSearchBar extends React.Component {
    constructor(props, context) {
        super(props, context);
        this.state = {
            filterText: ""
        };
        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(evt) {
        this.setState({ filterText: evt.target.value });
    }

    filterChildren() {
        return this.props.children.filter(child => {
            const name = (child.firstname + ' ' + child.lastname).toLowerCase();
            const normalizedname = name.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

            return !(this.state.filterText !== "" &&
                !(normalizedname.includes(this.state.filterText.toLowerCase()) || name.includes(this.state.filterText.toLowerCase())));

        });
    }

    render() {
        return (
            <main>
                <section className="pb-5">
                    <div className="page-wrapper">
                        <p className="title-1 text-center">child.list.list-children</p>
                        <div className="input-search">
                            <input type="text" id="searchInput"
                                   value={this.state.filterText}
                                   onChange={this.handleChange}
                                   placeholder="child.list.search-placeholder"
                            />
                            <button type="button" id="resetSearch" className=""><i className="fas fa-times-circle"/></button>
                        </div>

                        <ChildrenList children={this.filterChildren()} routePrefix={this.props.routePrefix}/>
                    </div>
                </section>
            </main>
        );
    }
}
