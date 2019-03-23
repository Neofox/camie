import React from "react";
import { Link } from "react-router-dom";
import SheetGirl from "../../../images/icon-fiche-fille.svg";
import SheetBoy from "../../../images/icon-fiche-garcon.svg";

const ChildrenList = ({children}) => (
    <div>
            {children.map((child, index) => (
                    <div key={index} className="box-user-2">
                            <Link to={"/child/" + child.id + "/sheet/daily" } className="box-user-2__left">
                                    {child.sexe === 'F' ? <img alt="icon-girl" src={SheetGirl} /> : <img alt="icon-boy" src={SheetBoy} />}
                                    <div className="left__name">{child.firstname} <br/> {child.lastname} <br/>
                                            <span>sheet.history.sheet-name-daily</span>
                                    </div>
                            </Link>
                            <div className="box-user-2__right">
                                    <Link to={"/child/" + child.id}>
                                            <button id={index} type="button" className="btn-icon"><i className="fas fa-user-circle" aria-label="hidden"/></button>
                                    </Link>
                                    <div className="right_info">Profil</div>
                            </div>
                    </div>
            ))}
    </div>
);

export default ChildrenList;
