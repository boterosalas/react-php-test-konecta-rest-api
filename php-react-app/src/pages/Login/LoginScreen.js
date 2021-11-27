import React, { useContext } from 'react';
import { AuthContext } from '../../auth/AuthContext';
import { types } from '../../types/types';
// import PropTypes from 'prop-types';
import './login.css';
import { useHistory } from 'react-router-dom';


const LoginScreen = props => {

    const navigate = useHistory();
    const { dispatch } = useContext(AuthContext);

    const handleSubmitLogin = (e) => {
        e.preventDefault();
        const action = {
            type: types.login,
            payload: {
                name: 'David'
            }
        }
        dispatch(action);
        const lastPath = localStorage.getItem('lastPath') || '/';
        navigate.replace(lastPath);
    }


    return (
        <>
            <div className="main-container">
                <form className="form-container" onSubmit={handleSubmitLogin}>
                    <input className="form-control" placeholder="Email" name="email" type="email" />
                    <input className="form-control" placeholder="Password" name="password" type="text" />
                    <div className="d-grid gap-2">
                        <button type="submit" className="btn btn-outline-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </>
    )
}

LoginScreen.propTypes = {

}

export default LoginScreen
