import Constants from "../constants/childrenConstants";

const Actions = {
    fetchChildren: baseUrl => dispatch => {
        dispatch({ type: Constants.CHILD_FETCHING });

        fetch(baseUrl + "/api/children")
            .then(response => response.json())
            .then(data => {
                dispatch({
                    type: Constants.CHILDREN_RECEIVED,
                    children: data
                });
            });
    },

    fetchChild: (id, baseUrl) => dispatch => {
        dispatch({ type: Constants.CHILD_FETCHING });

        fetch(baseUrl + "/api/children/" + id)
            .then(response => response.json())
            .then(data => {
                dispatch({
                    type: Constants.CHILD_RECEIVED,
                    child: data
                });
            });
    }
};

export default Actions;
