import {Route, Switch} from "react-router-dom";
import React from "react";
import ChildrenList from "../containers/childrenList";
import Child from "../containers/child";
import SheetsList from "../containers/sheetsList";
import DailySheet from "../containers/dailySheet";
import {CSSTransition, TransitionGroup} from "react-transition-group";

const Root = () => {
    return (
        <Route
            render={({ location }) => {
                return (
                    <TransitionGroup component={null}>
                        <CSSTransition timeout={300} classNames="fade" key={location.key}>
                            <Switch location={location}>
                                <Route path={"/"} exact component={ChildrenList} />
                                <Route path={"/child/:id/history"} exact component={SheetsList} />
                                <Route path={"/child/:id/sheet/daily"} exact render={(props) => <DailySheet {...props} readonly={false} />} />
                                <Route path={"/child/:id/sheet/:sheetId/history"} exact render={(props) => <DailySheet {...props} readonly={true} />} />
                                <Route path={"/child/:id"} exact component={Child} />
                            </Switch>
                        </CSSTransition>
                    </TransitionGroup>
                );
            }}
        />
    );
};

export default Root;
