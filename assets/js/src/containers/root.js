import { Route } from "react-router-dom";
import React from "react";
import ChildrenList from "../containers/childrenList";
import Child from "../containers/child";

const Root = () => {
    return (
        <div>
            <Route path={"/children/list"} exact component={ChildrenList} />
            <Route path={"/child/:id"} component={Child} />
        </div>
    );
};

export default Root;
