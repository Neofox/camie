import React from "react";
import {Link} from "react-router-dom";

const Child = ({child}) => (
    <main>
        <section className="pb-5">
            <div className="page-wrapper">
                <div className={`box-user ${child.sexe == 'F' ? 'box-user--girl' : ''}`}>
                    <div className="box-letters">{`${child.firstname.charAt(0).toUpperCase()}${child.lastname.charAt(0).toUpperCase()}`}</div>

                    <div className="box-user__content">
                        <form className="grid-flex mb-3">
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="firstname">child.profile.firstname</label>
                                    <input type="text" id="firstname" name="firstname" readOnly value={child.firstname}/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="lastname">child.profile.lastname</label>
                                    <input type="text" id="lastname" name="lastname" readOnly value={child.lastname}/>
                                </div>
                            </div>
                            <div className="column w-100">
                                <div className="input-animation">
                                    <label htmlFor="birthdate">child.profile.birthdate</label>
                                    <input type="date" id="birthdate" name="birthdate" readOnly value={ child.birthdate.substring(0, 10) } />
                                </div>
                            </div>
                            <div className="column w-100 mb-2">
                                <div className="input-group-radio" id="radioSexe">
                                    <div className="input-radio">
                                        <input type="radio" id="fille" name="radio2" className={child.sexe === 'F' ? 'input-radio--selected' : 'disabled'} disabled={child.sexe !== 'F'}/>
                                        <label htmlFor="fille"><i className="fas fa-venus"/> child.profile.girl</label>
                                    </div>
                                    <div className="input-radio">
                                        <input type="radio" id="garcon" name="radio2" className={child.sexe === 'M' ? 'input-radio--selected' : 'disabled'} disabled={child.sexe !== 'M'}/>
                                        <label htmlFor="garcon"><i className="fas fa-mars"/> child.profile.boy</label>
                                    </div>
                                </div>
                            </div>

                            {child.users.map((user, index) => {
                                if (!user.roles.includes('ROLE_GUARDIAN')) {
                                    return ''
                                }
                                return (
                                    <div className="column w-100" key={index}>
                                        <div className="column w-100">
                                            <div className="input-animation">
                                                <label htmlFor={'guardian' + {index}}>child.profile.guardian-name</label>
                                                <input type="text" id={'guardian' + {index}} name="user" readOnly value={ user.firstname + " " + user.lastname }/>
                                            </div>
                                        </div>

                                        <div className="column w-100">
                                            <div className="input-animation">
                                                <label htmlFor={'phone' + {index}}>child.profile.guardian-phone</label>
                                                <input type="text" id={'phone' + {index}} readOnly name="phone" value={user.phone}/>
                                            </div>
                                        </div>

                                        <div className="column w-100">
                                            <div className="input-animation">
                                                <label htmlFor={'email' + {index}}>child.profile.guardian-email</label>
                                                <input type="email" id={'email' + {index}} readOnly name="email" value={ user.email }/>
                                            </div>
                                        </div>
                                    </div>
                                )
                            })}

                            <div className="column w-100">
                                <div className="input-animation textarea">
                                    <label htmlFor="comment">child.profile.comment</label>
                                    <textarea id="comment" name="comment" readOnly/>
                                    {/*<textarea id="comment" name="comment" readonly>{child.comment}</textarea>*/}
                                </div>
                            </div>
                        </form>

                        <Link to={'/child/' + child.id + '/history'} className="btn bg-blue fa-history left d-block">child.profile.show-history</Link>
                    </div>
                </div>
            </div>
        </section>
    </main>
);

export default Child;
