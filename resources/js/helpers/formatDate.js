import moment from 'moment';

export const formatDate = (dateString) => {

    if(!dateString) return 'Please set a date!'
    const date = new Date(dateString);
    // Then specify how you want your dates to be formatted
    return moment(dateString).format('DD-MM-YYYY');
}

export const isValidDate = (dateString) => {
    return moment(dateString, 'YYYY-MM-DD HH:mm:ss', true).isValid();
}
