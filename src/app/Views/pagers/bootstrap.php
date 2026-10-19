<?php
/**
 * Bootstrap 5 pager: [ Previous ] [ 1 ] [ 2 ] [ Next ]
 *
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2);

// Nothing to page through, so show nothing.
if ($pager->getPageCount() <= 1) {
    return;
}
?>
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasPreviousPage() ? esc($pager->getPreviousPage()) : '#' ?>">Previous</a>
        </li>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= esc($link['uri']) ?>"><?= esc($link['title']) ?></a>
            </li>
        <?php endforeach; ?>

        <li class="page-item <?= $pager->hasNextPage() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasNextPage() ? esc($pager->getNextPage()) : '#' ?>">Next</a>
        </li>
    </ul>
</nav>
