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
        if (!this.props.sheet || this.props.sheet.id.toString() !== this.props.match.params.sheetId) {
            const { dispatch } = this.props;
            dispatch(SheetsActions.fetchSheet(this.props.match.params.id, this.props.match.params.sheetId, this.props.baseUrl));
        }
    }

    getChild() {
        if (
            this.props.fetching ||
            !this.props.child || this.props.child.id.toString() !== this.props.match.params.id ||
            !this.props.sheet || this.props.sheet.id.toString() !== this.props.match.params.sheetId
        ) {
            return <div>Loading...</div>;
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
    sheet: state.sheetsState.sheet,
    fetching: state.childrenState.fetching,
    baseUrl: state.appState.baseUrl
});

export default connect(mapStateToProps)(DailySheet);
