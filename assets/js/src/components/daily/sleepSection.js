import React from "react";

const SleepSection = ({sleep, readonly = false}) => {
    return (<button type="button" className="btn-3" data-modal={!readonly ? "validate_modal" : ''}>
        <input type="hidden" name="type" value="sleep"/>
        <div className="btn-3__wrapper">
            <span className="btn-3__icon"><span><i className="fa fa-bed"/></span></span>
            <span className="btn-3__title">sheet.daily.sleeping<br/>
                <span className="title__sub-title">sheet.daily.sleeping.from <span>{sleep.start}</span> sheet.daily.sleeping.to <span>{sleep.end}</span></span>
            </span>
            {!readonly ? <span className="btn-3__remove"><i className="fa fa-trash"/></span> : ''}
        </div>
    </button>)
};

export default SleepSection
