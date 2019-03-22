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
    children: state.camieState.children,
    nursery: state.camieState.user.nursery,
    fetching: state.camieState.fetching,
    baseUrl: state.camieState.baseUrl
});

export default connect(mapStateToProps)(ChildrenList);
