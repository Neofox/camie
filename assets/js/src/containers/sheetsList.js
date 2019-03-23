import React from "react";
import Actions from "../actions/sheetsActions";
import { connect } from "react-redux";
import SheetsListComponent from "../components/sheetsList";

class SheetsList extends React.Component {
    componentDidMount() {
        if (!this.props.sheets) {
            const { dispatch } = this.props;
            dispatch(Actions.fetchSheets(this.props.child.id, this.props.baseUrl));
        }
    }
    render() {
        if (this.props.fetching || !this.props.sheets || !this.props.child) {
            return <div>Loading...</div>;
        } else {
            return (
                <div>
                    <SheetsListComponent child={this.props.child} sheets={this.props.sheets} routePrefix={""} />
                </div>
            );
        }
    }
}

const mapStateToProps = state => ({
    child: state.childrenState.child,
    sheets: state.sheetsState.sheets,
    fetching: state.sheetsState.fetching,
    baseUrl: state.appState.baseUrl
});

export default connect(mapStateToProps)(SheetsList);
