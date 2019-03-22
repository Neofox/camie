import childrenReducer from "./childrenReducer";
import { initialState as camieState } from "./childrenReducer";
import { combineReducers } from "redux";

// Combine all reducers you may have here
export default combineReducers({
    camieState: childrenReducer
});

export const initialStates = {
    camieState
};
