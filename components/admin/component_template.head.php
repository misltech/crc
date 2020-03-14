<?php
/**
 * Print out the skeleton head.
 * 
 * @param string $id    The HTML ID of the desired modal.
 */
function modalHead($id)
{
    ?>
    <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <?php
        }
        ?>