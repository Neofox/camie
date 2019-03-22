import { Route } from "react-router-dom";
import React from "react";
import ChildrenList from "../containers/childrenList";
import Child from "../containers/child";
import SheetsList from "../containers/sheetsList";

const Root = () => {
    return (
        <div>
            <Route path={"/"} exact component={ChildrenList} />
            <Route path={"/child/:id/history"} exact component={SheetsList} />
            <Route path={"/child/:id"} exact component={Child} />
        </div>
    );
};

export default Root;
