import React, { useContext } from 'react'
import { Redirect } from 'react-router-dom';
import { AuthContext } from '../auth/AuthContext'

const PrivateRoutes = ({ children }) => {

    const { user } = useContext(AuthContext);

    return user.logged ?
        children : <Redirect to="/login" />
}

export default PrivateRoutes
