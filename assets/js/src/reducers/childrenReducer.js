import Constants from "../constants/childrenConstants";

export const initialState = {
    fetching: false,
};

export default function childrenReducer(state = initialState, action) {
    switch (action.type) {
        case Constants.CHILDREN_FETCHING:
            return { ...state, fetching: true };

        case Constants.CHILDREN_RECEIVED:
            return {
                ...state,
                child: null,
                children: action.children,
                fetching: false
            };

        case Constants.CHILD_FETCHING:
            return { ...state, fetching: true };

        case Constants.CHILD_RECEIVED:
            return {
                ...state,
                children: null,
                child: action.child,
                fetching: false
            };

        default:
            return state;
    }
}
