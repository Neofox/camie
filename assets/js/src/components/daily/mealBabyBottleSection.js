import React from "react";

const MealBabyBottleSection = ({meal, readonly = false}) => (
    <button type="button" className="btn-3" data-modal={ !readonly ? "validate_modal" : ''}>
        <input type="hidden" name="type" value="meal"/>
        <div className="btn-3__wrapper">
            <span className="btn-3__icon"><span><i className="fa fa-utensils"/></span></span>
            <span className="btn-3__title">sheet.daily.meal.babybottle<br/>
                <span className="title__sub-title">
                    {meal.detail ? <span>{meal.details} ml</span> : ''}
                    sheet.daily.meal.at <span>{meal.hour}</span>
                </span>
            </span>
            { !readonly ? <span className="btn-3__remove"><i className="fa fa-trash"/></span> : ''}
        </div>
    </button>
);

export default MealBabyBottleSection
