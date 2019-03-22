import React from "react";
import Actions from "../actions/childrenActions";
import { connect } from "react-redux";
import Child from "../components/child";

class Recipe extends React.Component {
    componentDidMount() {
        if (!this.props.recipe || this.props.recipe.id.toString() !== this.props.match.params.id) {
            const { dispatch } = this.props;
            dispatch(Actions.fetchChild(this.props.match.params.id, this.props.baseUrl));
        }
    }

    getRecipe() {
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
                    <Child child={this.props.child} />
                </div>
            );
        }
    }

    render() {
        return this.getRecipe();
    }
}

const mapStateToProps = state => ({
    child: state.childrenState.child,
    fetching: state.childrenState.fetching,
    baseUrl: state.childrenState.baseUrl
});

export default connect(mapStateToProps)(Recipe);
