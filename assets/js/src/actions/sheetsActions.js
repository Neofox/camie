import Constants from "../constants/sheetsConstants";

const Actions = {
    fetchSheets: (childId, baseUrl) => dispatch => {
        dispatch({ type: Constants.SHEETS_FETCHING });

        fetch(baseUrl + "/api/children/" + childId + '/sheets')
            .then(response => response.json())
            .then(data => {
                dispatch({
                    type: Constants.SHEETS_RECEIVED,
                    sheets: data
                });
            });
    },

    fetchSheet: (childId, sheetId, baseUrl) => dispatch => {
        dispatch({ type: Constants.SHEET_FETCHING });

        fetch(baseUrl + "/api/children/" + childId + '/sheets/' + sheetId)
            .then(response => response.json())
            .then(data => {
                dispatch({
                    type: Constants.SHEET_RECEIVED,
                    sheet: data
                });
            });
    },

    fetchDailySheet: (childId, baseUrl) => dispatch => {
        dispatch({ type: Constants.SHEET_FETCHING });

        fetch(baseUrl + "/api/children/" + childId + '/sheet/daily')
            .then(response => response.json())
            .then(data => {
                dispatch({
                    type: Constants.SHEET_RECEIVED,
                    sheet: data
                });
            });
    }
};

export default Actions;
