/*!
 * FileInput Spanish (Latin American) Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinput.locales.es = {
        fileSingle: 'Arquivo',
        filePlural: 'arquivos',
        browseLabel: 'Buscar &hellip;',
        removeLabel: 'Deletar',
        removeTitle: 'Limpar arquivos selecionados',
        cancelLabel: 'Cancelar',
        cancelTitle: 'Cancelar atualização',
        uploadLabel: 'Upload de arquivo',
        uploadTitle: 'Upload de arquivos selecionados',
        msgSizeTooLarge: 'Arquivo "{name}" (<b>{size} KB</b>) excede o tamanho máximo permitido de <b>{maxSize} KB</b>. Por favor, tente seu upload!',
        msgFilesTooLess: 'Você deve selecionar ao menos <b>{n}</b> {files} para upload. Por favor tente sue upload!',
        msgFilesTooMany: 'O número de arquivos selecionado para upload <b>({n})</b> excede o limite máximo permitido de <b>{m}</b>. Por favor tente seu upload',
        msgFileNotFound: 'Arquivo "{name}" não encontrado!',
        msgFileSecured: 'Restrições de segurança bloquearam a leitura do arquivo "{name}".',
        msgFileNotReadable: 'Arquivo "{name}" não pode ser lido.',
        msgFilePreviewAborted: 'A pré visualização do arquivo foi cancelado para "{name}".',
        msgFilePreviewError: 'Erro de leitura no arquivo "{name}".',
        msgInvalidFileType: 'Tipo de arquivo inválido pelo arquivo "{name}". Só arquivos "{types}" são permitidos.',
        msgInvalidFileExtension: 'Extensão de arquivo inválido para "{name}". Só arquivos "{extensions}" são permitidos.',
        msgValidationError: 'Error ao carregar o arquivo',
        msgLoading: 'Carregando arquivo {index} of {files} &hellip;',
        msgProgress: 'Carregando arquivo {index} of {files} - {name} - {percent}% completado.',
        msgSelected: '{n} arquivos selecionados',
        msgFoldersNotAllowed: 'Arrastre e solte somente arquivos! Omitir {n} pasta(s).',
        dropZoneTitle: 'Arrastre e soltar os arquivos aqui  &hellip;'

    };

    $.extend($.fn.fileinput.defaults, $.fn.fileinput.locales.es);
})(window.jQuery);
