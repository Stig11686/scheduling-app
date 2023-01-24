export default function formatDate(dateString) {
    const date = new Date(dateString);
    // Then specify how you want your dates to be formatted
    return date.toLocaleDateString();
}
