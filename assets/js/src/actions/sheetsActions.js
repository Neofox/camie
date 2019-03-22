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
    }
};

export default Actions;
