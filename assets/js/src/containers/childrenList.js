import React from "react";
import Actions from "../actions/childrenActions";
import { connect } from "react-redux";
import ChildrenListComponent from "../components/childrenListSearchBar";

class ChildrenList extends React.Component {
    componentDidMount() {
        if (!this.props.children) {
            const { dispatch } = this.props;
            dispatch(Actions.fetchChildren(this.props.nursery.id, this.props.baseUrl));
        }
    }
    render() {
        if (this.props.fetching || !this.props.children) {
            return <div>Loading...</div>;
        } else {
            return (
                <div>
                    <ChildrenListComponent children={this.props.children} routePrefix={""} />
                </div>
            );
        }
    }
}

const mapStateToProps = state => ({
    children: state.childrenState.children,
    fetching: state.childrenState.fetching,
    nursery: state.appState.user.nursery,
    baseUrl: state.appState.baseUrl
});

export default connect(mapStateToProps)(ChildrenList);
