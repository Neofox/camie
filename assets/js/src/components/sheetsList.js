import React from "react";
import { Link } from "react-router-dom";
import SheetGirl from "../../../images/icon-fiche-fille.svg";
import SheetBoy from "../../../images/icon-fiche-garcon.svg";

const SheetsList = ({child, sheets}) => (
    <main className="bg-pink-light">
        <section className="pb-5">
            <div className="page-wrapper">
                <div className="title-special">
                    <p>
                        {child.firstname}<br/>
                        {child.lastname}
                    </p>
                    <p>{child.birthdate} sheet.history.age-year</p>
                </div>

                {sheets.map((sheet, index) => (
                    <div key={index} className="box-history">
                        <Link to={'/child/' + child.id + '/sheet/' + sheet.id + '/history'} className="box-history__left">
                            <p>{sheet.createdAt}</p>
                            <small>{'sheet.history.sheet-name-' + sheet.type}</small>
                        </Link>
                        <div className="box-history__right">
                            <a href={"/child/" + child.id + "/sheet/" + sheet.id + "/download"}>
                                <button type="button" data-modal="success_modal" className="btn-icon">
                                    <i className="fas fa-download"/>
                                </button>
                            </a>
                            <a href={"/child/" + child.id + "/sheet/" + sheet.id + "/send"}>
                                <button type="button" data-modal="success_modal" className="btn-icon">
                                    <i className="fas fa-paper-plane"/>
                                </button>
                            </a>
                        </div>
                    </div>
                ))}

            </div>
        </section>
    </main>
);

export default SheetsList;
