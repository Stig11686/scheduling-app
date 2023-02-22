export default function formatDate(dateString) {

    if(!dateString) return 'Please set a date!'
    const date = new Date(dateString);
    // Then specify how you want your dates to be formatted
    return date.toLocaleDateString();
}
