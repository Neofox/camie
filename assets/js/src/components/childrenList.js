import React from "react";
import { Link } from "react-router-dom";

const ChildrenList = props => (
    <div>
        {props.children.map((child, index) => (
            <div key={index}>
                <Link to={"/child/" + child.id}>
                    <div key={index} id={index}>
                        {child.firstname}
                    </div>
                </Link>
            </div>
        ))}
    </div>
);

export default ChildrenList;
