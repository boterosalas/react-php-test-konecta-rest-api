import React, { useContext } from 'react'
import { AuthContext } from '../../auth/AuthContext';
// import PropTypes from 'prop-types'


const HomeScreen = props => {

    const { user } = useContext(AuthContext);

    return (
        <>
            <h1>This is the home screen</h1>
        </>
    )
}

HomeScreen.propTypes = {

}

export default HomeScreen
