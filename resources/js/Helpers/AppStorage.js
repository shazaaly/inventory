//class containing methods to store, clear and get: tokens and user data
class AppStorage {

    storeToken(token) {
        //store name and value of token
        localStorage.setItem('token', token)

    }

    storeUser(user) {
        //store name and value of user data

        localStorage.setItem('user', user)
    }

    store(token, user) {
        this.storeToken(token)
        this.storeUser(user)

    }

    clear() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')

    }

    getToken() {
        localStorage.getItem('token');

    }

    getUser() {
        localStorage.getItem('user');

    }

}

export default AppStorage = new AppStorage();
