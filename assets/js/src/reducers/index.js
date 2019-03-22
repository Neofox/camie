import childrenReducer from "./childrenReducer";
import sheetsReducer from "./sheetsReducer";
import appReducer from "./appReducer";
import { initialState as childrenState } from "./childrenReducer";
import { initialState as sheetsState } from "./sheetsReducer";
import { initialState as appState } from "./appReducer";
import { combineReducers } from "redux";

// Combine all reducers you may have here
export default combineReducers({
    appState: appReducer,
    childrenState: childrenReducer,
    sheetsState: sheetsReducer
});

export const initialStates = {
    appState, childrenState, sheetsState
};
