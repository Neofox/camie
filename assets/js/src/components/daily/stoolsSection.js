import React from "react";

function stoolType(stool) {
    let stooltype = 'sheet.daily.stool.normal';
    switch (stool) {
        case 'l':
            stooltype = 'sheet.daily.stool.liquid';
            break;
        case 's':
            stooltype = 'sheet.daily.stool.soft';
            break;
        case 'n':
            stooltype = 'sheet.daily.stool.normal';
            break;
    }
    return stooltype;
}

const StoolsSection = ({stool, readonly = false}) => (
    <button type="button" className="btn-3" data-modal={ !readonly ? "validate_modal" : ''}>
        <input type="hidden" name="type" value="stools"/>
        <div className="btn-3__wrapper">
            <span className="btn-3__icon"><span><i className="fa fa-toilet-paper"/></span></span>
            <span className="btn-3__title">sheet.daily.stool <span className="c-blue">{stoolType(stool.stool)}</span><br/>
                <span className="title__sub-title">sheet.daily.stool.at <span>{stool.time}</span> {stool.accident ? 'sheet.daily.stool.by-accident' : 'sheet.daily.stool.not-by-accident' }
                </span>
            </span>
            { !readonly ? <span className="btn-3__remove"><i className="fa fa-trash"/></span> : ''}
        </div>
        <p>
            {stool.comment}
        </p>
    </button>
);

export default StoolsSection
