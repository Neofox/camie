import React from "react";

const MealMenuOfDaySection = ({meal, readonly = false}) => (
    <button type="button" className="btn-3" data-modal={ !readonly ? "validate_modal" : ''}>
        <input type="hidden" name="type" value="meal"/>
        <div className="btn-3__wrapper">
            <span className="btn-3__icon"><span><i className="fa fa-utensils"/></span></span>
            <span className="btn-3__title">sheet.daily.meal.menuofday<br/>
                <span className="title__sub-title">
                    sheet.daily.meal.menuofday.entrance: <span>{('sheet.daily.modal.meal-eat-' + meal.entrance)}</span><br/>
                    sheet.daily.meal.menuofday.dish: <span>{('sheet.daily.modal.meal-eat-' + meal.dish)}</span><br/>
                    sheet.daily.meal.menuofday.dessert: <span>{('sheet.daily.modal.meal-eat-' + meal.dessert)}</span>
                </span>
            </span>
            { !readonly ? <span className="btn-3__remove"><i className="fa fa-trash"/></span> : ''}
        </div>
    </button>
);

export default MealMenuOfDaySection
