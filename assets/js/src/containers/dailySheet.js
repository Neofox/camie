import React from "react";
import ChildrenActions from "../actions/childrenActions";
import SheetsActions from "../actions/sheetsActions";
import { connect } from "react-redux";
import DailySheetComponent from "../components/daily/dailySheet";

class DailySheet extends React.Component {
    componentDidMount() {
        if (!this.props.child || this.props.child.id.toString() !== this.props.match.params.id) {
            const { dispatch } = this.props;
            dispatch(ChildrenActions.fetchChild(this.props.match.params.id, this.props.baseUrl));
        }
        if (!('sheetId' in this.props.match.params)) {
            const { dispatch } = this.props;
            dispatch(SheetsActions.fetchDailySheet(this.props.match.params.id, this.props.baseUrl));
        } else {
            const { dispatch } = this.props;
            dispatch(SheetsActions.fetchSheet(this.props.match.params.id, this.props.match.params.sheetId, this.props.baseUrl));
        }
    }

    getChild() {
        if (this.props.childFetching || !this.props.child || this.props.child.id.toString() !== this.props.match.params.id) {
            return <div>Loading child...</div>;
        } else if (this.props.sheetFetching || !this.props.sheet || ('id' in this.props.sheet && this.props.sheet.id != this.props.match.params.sheetId)) {
            return <div>Loading sheet...</div>;
        } else {
            return (
                <div>
                    <DailySheetComponent child={this.props.child} sheet={this.props.sheet} readonly={this.props.readonly} />
                </div>
            );
        }
    }

    render() {
        return this.getChild();
    }
}

const mapStateToProps = state => ({
    child: state.childrenState.child,
    childFetching: state.childrenState.fetching,
    sheetFetching: state.sheetsState.fetching,
    sheet: state.sheetsState.sheet,
    baseUrl: state.appState.baseUrl
});

export default connect(mapStateToProps)(DailySheet);
