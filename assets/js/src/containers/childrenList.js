import React from "react";
import Actions from "../actions/childrenActions";
import { connect } from "react-redux";
import ChildrenList from "../components/childrenList";

class Recipes extends React.Component {
    componentDidMount() {
        if (!this.props.children) {
            const { dispatch } = this.props;
            dispatch(Actions.fetchChildren(this.props.baseUrl));
        }
    }
    render() {
        if (this.props.fetching || !this.props.children) {
            return <div>Loading...</div>;
        } else {
            return (
                <div>
                    <ChildrenList children={this.props.children} routePrefix={""} />
                </div>
            );
        }
    }
}

const mapStateToProps = state => ({
    children: state.childrenState.children,
    fetching: state.childrenState.fetching,
    baseUrl: state.childrenState.baseUrl
});

export default connect(mapStateToProps)(Recipes);
