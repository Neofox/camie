import childrenReducer from "./childrenReducer";
import { initialState as childrenState } from "./childrenReducer";
import { combineReducers } from "redux";

// Combine all reducers you may have here
export default combineReducers({
    childrenState: childrenReducer
});

export const initialStates = {
    childrenState
};
