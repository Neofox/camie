import React from "react";

const Child = props => (
    <div>
        {props.child.firstname} {props.child.lastname}
    </div>
);

export default Child;
