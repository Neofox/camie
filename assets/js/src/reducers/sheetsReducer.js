import Constants from "../constants/sheetsConstants";

export const initialState = {
    fetching: false,
};

export default function sheetsReducer(state = initialState, action) {
    switch (action.type) {
        case Constants.SHEETS_FETCHING:
            return { ...state, fetching: true };

        case Constants.SHEETS_RECEIVED:
            return {
                ...state,
                sheets: action.sheets,
                fetching: false
            };

        case Constants.SHEET_FETCHING:
            return { ...state, fetching: true };

        case Constants.SHEET_RECEIVED:
            return {
                ...state,
                sheet: action.sheet,
                fetching: false
            };

        default:
            return state;
    }
}
