import React from "react";
import SleepSection from "./sleepSection";
import StoolsSection from "./stoolsSection";
import BabyBottleSection from "./mealBabyBottleSection";
import BreadSoupSection from "./mealBreadSoupSection";
import MenuOfDaySection from "./mealMenuOfDaySection";
import GreenClock from "../../../../images/icon-clock-green.svg";
import RedClock from "../../../../images/icon-clock-red.svg";

const DailySheet = ({child, sheet, readonly = false}) => (
    <main>
        <section className="pb-5">
            <div className="page-wrapper">
                <div className="box-user {% if child.sexe == 'F' %}box-user--girl{% endif %}">
                    <div className="box-letters">{`${child.firstname.charAt(0).toUpperCase()}${child.lastname.charAt(0).toUpperCase()}`}</div>

                    <div className="box-user__content">
                        <form id="dailySheetForm" className="grid-flex">
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="arrival_time">sheet.daily.arrival-time</label>
                                    <input type="time" id="arrival_time" name="arrival_time" value={ sheet.data.arrival_time } readOnly={readonly} placeholder="hh:mm"/>
                                    <img src={GreenClock} alt="green clock"/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="communication">sheet.daily.communication-received</label>
                                    <input type="text" id="communication" name="communication" value={ sheet.data.communication } readOnly={readonly} placeholder="sheet.daily.communication-received"/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="departure_time">sheet.daily.departure-time</label>
                                    <input type="time" id="departure_time" name="departure_time" value={ sheet.data.departure_time } readOnly={readonly} placeholder="hh:mm"/>
                                    <img src={RedClock} alt="red clock"/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="activities">sheet.daily.activities</label>
                                    <input type="text" id="activities" name="activities" value={ sheet.data.activities } readOnly={readonly} placeholder="sheet.daily.activities-placeholder"/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="nurse_comment">sheet.daily.nurse-comment</label>
                                    <textarea id="nurse_comment" name="nurse_comment" readOnly={readonly} placeholder="sheet.daily.nurse-comment-placeholder" value={sheet.data.nurse_comment} />

                                </div>
                            </div>

                            <input type="hidden" name="sheet_type" value={1} /> {/*TODO: find a better way (maybe remove it?)*/}
                            <input type="hidden" name="sheet_id" value={sheet.id} />
                        </form>


                        {sheet.data.sleep !== undefined ? Object.values(sheet.data.sleep).map((sleep, index) => <SleepSection key={index} sleep={sleep} readonly={readonly} />) : ''}
                        {sheet.data.stools !== undefined ? Object.values(sheet.data.stools).map((stool, index) =><StoolsSection key={index} stool={stool} readonly={readonly} />) : ''}
                        {sheet.data.meal !== undefined ? Object.values(sheet.data.meal).map((meals, index) => {
                            let meal = Object.values(meals)[0];
                            switch (Object.keys(meals)[0]) {
                                case 'babybottle':
                                    return <BabyBottleSection key={index} meal={meal} readonly={readonly} />;
                                case 'breadsoup':
                                    return <BreadSoupSection key={index} meal={meal} readonly={readonly} />;
                                case 'menuofday':
                                    return <MenuOfDaySection key={index} meal={meal} readonly={readonly} />;
                            }
                        }) : ''}


                        { !readonly ? `
                        <button type="button" data-modal="addMeals" className="btn bg-blue fa-utensils left d-block mb-2">
                            sheet.daily.add-meal
                        </button>
                        <button type="button" data-modal="addSleep" className="btn bg-blue fa-bed left d-block mb-2">
                            sheet.daily.add-sleep
                        </button>
                        <button type="button" data-modal="addStools" className="btn bg-blue fa-toilet-paper left d-block mb-2">
                            sheet.daily.add-stools
                        </button>

                        <hr/><br/>
                        <button type="button" name="addSheet" id="addSheet" data-modal="success_modal" className="btn bg-green d-block mb-2">sheet.daily.add</button>
                        ` : ''}
                    </div>
                </div>
            </div>
        </section>
    </main>
);

export default DailySheet;
