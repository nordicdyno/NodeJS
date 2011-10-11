use Time::HiRes qw(time);
use JSON::XS;

$/ = '';
my $tt = time;

my $t = time;
open JSON, 'example.json' or die "Can't open file: $!\n";
my $json = <JSON>;
close JSON;
printf "json.read: %dms\n", int((time - $t) * 1000 + 0.5);

$t = time;
my $obj = JSON::XS->new->ascii->decode($json);
printf "json.parse: %dms\n", int((time - $t) * 1000 + 0.5);

$t = time;
map { my %new_obj; $m = $_; $new_obj{$_} = $m{$_} foreach keys %$m; } @{$obj->{'data'}->{'messages'}};
printf "json.transform: %dms\n", int((time - $t) * 1000 + 0.5);

printf "all: %dms\n", int((time - $tt) * 1000 + 0.5);

