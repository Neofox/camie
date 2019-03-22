import React from "react";
import Actions from "../actions/childrenActions";
import { connect } from "react-redux";
import ChildComponent from "../components/child";

class Child extends React.Component {
    componentDidMount() {
        if (!this.props.child || this.props.child.id.toString() !== this.props.match.params.id) {
            const { dispatch } = this.props;
            dispatch(Actions.fetchChild(this.props.match.params.id, this.props.baseUrl));
        }
    }

    getChild() {
        // if we know that we are loading thata
        if (
            this.props.fetching ||
            // or we do not have a child
            !this.props.child ||
            // or the child we have is not the one we should have
            this.props.child.id.toString() !== this.props.match.params.id
        ) {
            return <div>Loading...</div>;
        } else {
            return (
                <div>
                    <ChildComponent child={this.props.child} />
                </div>
            );
        }
    }

    render() {
        return this.getChild();
    }
}

const mapStateToProps = state => ({
    child: state.camieState.child,
    fetching: state.camieState.fetching,
    baseUrl: state.camieState.baseUrl
});

export default connect(mapStateToProps)(Child);
