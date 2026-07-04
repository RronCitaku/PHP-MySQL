<?php
function safe_text($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

function redirect_to($page)
{
    header("Location: " . $page);
    exit();
}

function car_image_url($filename, $prefix = "")
{
    $filename = basename((string) $filename);
    $image_path = __DIR__ . "/images/" . $filename;

    if ($filename != "" && file_exists($image_path)) {
        return $prefix . "images/" . $filename;
    }

    return $prefix . "images/";
}

function rent_status_badge_class($status)
{
    if ($status == "approved") {
        return "bg-success";
    }

    if ($status == "cancelled") {
        return "bg-secondary";
    }

    return "bg-warning text-dark";
}

function render_footer()
{
    ?>
    <footer class="border-top bg-light text-muted py-3 mt-auto">
        <div class="container text-center small">
            Car Rental System &copy; <?php echo date("Y"); ?>
        </div>
    </footer>
    <?php
}
?> 