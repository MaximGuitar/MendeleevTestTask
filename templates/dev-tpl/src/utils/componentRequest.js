import ky from 'ky';

/**
 * 
 * @param {string} component название компонента
 * @param {string} action ajax действие
 * @param {import('ky').Options} params параметры запроса
 * @returns {object} результат запроса
 */
const componentRequest = async (component, action, params = {}) => {
    const query = {
        c: component,
        action,
        mode: 'ajax',
        sessid: window.sessid
    };

    const result = await ky(`/bitrix/services/main/ajax.php?${new URLSearchParams(query).toString()}`, params).json()
    if (result.status == "error") {
        throw new Error("Ошибка")
    }
    return result
}
export default componentRequest